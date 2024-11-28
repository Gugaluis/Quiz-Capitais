<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\View\View;

class MainController extends Controller
{

    private $app_data;

    public function __construct()
    {
        // Carrega o arquivo app_data.php da pasta 
        $this->app_data = require(app_path('app_data.php'));

    }

    public function startGame(): View
    {
        return view('home');
    }

    public function prepareGame(Request $request)
    {
        // Valida a requisição
        $request->validate(
            [
                'total_questions'=> 'required|integer|min:3|max:30'
            ],

            [
                'total_questions.required'=> 'O número de questões é obrigatório',
                'total_questions.integer'=> 'O número de questões tem que ser um valor inteiro',
                'total_questions.min'=> 'O número minimo de questões é :min',
                'total_questions.max'=> 'O número máximo de questões é :max',
            ]
        );

        // Recebendo o total de questões
        $total_questions = intval($request->input('total_questions'));

        // Prepara toda a estrutura o quiz
        $quiz = $this->prepareQuiz($total_questions);

        // Armazena o quiz na sessão
        session()->put([
            'quiz' => $quiz,
            'total_questions' => $total_questions,
            'current_question' => 1,
            'correct_answers' => 0,
            'wrong_answers' => 0
        ]);

        return redirect()->route('game');
    }


    private function prepareQuiz($total_questions)
    {
        $questions = [];
        $total_countries = count($this->app_data);

        $indexes = range(0, $total_countries -1);
        shuffle($indexes);
        $indexes = array_slice($indexes, 0, $total_questions);

        // Cria o array de questões
        $question_number = 1;
        foreach ($indexes as $index)
        {
            $question['question_number'] = $question_number++ ;
            $question['country'] = $this->app_data[$index]['country'];
            $question['correct_answer'] = $this->app_data[$index]['capital'];

            // Respostas erradas
            $other_capitals = array_column($this->app_data, 'capital');


            // Remove a resposta correta
            $other_capitals = array_diff($other_capitals, [$question['correct_answer']]);

            // Sorteia as opções erradas
            shuffle($other_capitals);
            $question['wrong_answers'] = array_slice($other_capitals, 0, 3);

            // Guarda a resposta correta
            $question['correct'] = null;

            $questions [] = $question;

        }

        return $questions;
    }

    public function game(): View
    {
        $quiz = session('quiz');
        $total_questions = session('total_questions');
        $current_question = session('current_question') - 1;

        // Prepara as perguntas para aparecerem na view
        $answers = $quiz[$current_question]['wrong_answers'];
        $answers[] = $quiz[$current_question]['correct_answer'];


        shuffle($answers);

        return view('game')->with([
            'country' => $quiz[$current_question]['country'],
            'totalQuestions' => $total_questions,
            'currentQuestion' => $current_question,
            'answers' => $answers
        ]);
    }

    public function answer($enc_answer)
    {
        try {
            $answer = Crypt::decryptString($enc_answer);
        } catch (\Exception $e) {
            return redirect()->route('game');
        }

        $quiz = session ('quiz');
        $current_question = session('current_question')-1;
        $correct_answer = $quiz[$current_question]['correct_answer'];
        $correct_answers = session('correct_answers');
        $wrong_answers = session('wrong_answers');

        if($answer == $correct_answer){
            $correct_answers++;
            $quiz[$current_question]['correct'] = true;
        } else { 
            $wrong_answers++;
            $quiz[$current_question]['correct'] = false;
        }

        // Atualiza a sessão com a pontuação
        session()->put(['quiz' => $quiz,'correct_answers' => $correct_answers,'wrong_answers' => $wrong_answers,]);

        // Prepara os dados para apresentar opção correta
        $data = [
            'country' => $quiz[$current_question]['country'],
            'correct_answer' => $correct_answer,
            'choice_answer' => $answer,
            'currentQuestion' => $current_question,
            'totalQuestions' => session('total_questions')
        ];

        return view('answer_result')->with($data);
    }

    public function nextQuestion()
    {
        $current_question = session('current_question');
        $total_questions = session('total_questions');

        if($current_question < $total_questions){
            $current_question++;
            session()->put('current_question', $current_question);
            return redirect()->route('game');
        } else {
            return redirect()->route('show_resultados');
        }
    }

    public function showResultados()
    {
        $total_questions = session('total_questions');

        return view('final_results')->with([
            'correct_answers' => session('correct_answers'),
            'wrong_answers' => session('wrong_answers'),
            'total_questions' => session('total_questions'),
            'percentage' => round(  session('correct_answers') / session('total_questions') * 100, 2)
        ]);
        
    }
}




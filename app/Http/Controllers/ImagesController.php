<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\Request;
use League\Glide\Responses\LaravelResponseFactory;
use League\Glide\ServerFactory;
use Inertia\Inertia;
use App\Models\Question;
use App\Models\Image;

class ImagesController extends Controller
{
    public function index()
    {
        return Inertia::render('Quiz/Images/Index', [
            'questions' => Question::with('image')->where('')->get()
            ->transform(fn ($question) => [
                'image' => $question->image->filename ?? null,
                'description' => $question->description
            ])
        ]);
    }

    public function show(Filesystem $filesystem, Request $request, $path)
    {
        $server = ServerFactory::create([
            'response' => new LaravelResponseFactory($request),
            'source' => $filesystem->getDriver(),
            'cache' => $filesystem->getDriver(),
            'cache_path_prefix' => '.glide-cache',
        ]);

        return $server->getImageResponse($path, $request->all());
    }
}

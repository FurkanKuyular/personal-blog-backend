<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Message;
use App\Service\Contacts\ContactInterface;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends Controller
{
    /**
     * @throws BindingResolutionException
     * @throws \Exception
     */
    public function store(ContactRequest $request): JsonResponse
    {
        /** @var ContactInterface $contactService */
        $contactService = app()->make(ContactInterface::class);

        $message = $contactService->createMessage($request->collect());

        if (!($message instanceof Message)) {
            throw new \Exception();
        }

        return response()->json([
            'message' => 'Message successfully created',
        ], Response::HTTP_CREATED);
    }
}

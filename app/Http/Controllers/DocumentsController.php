<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Models\Document;
use App\Models\User;
use App\Http\Resources\DocumentsResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreDocumentRequest;

class DocumentsController extends Controller
{
    use HttpResponses;
    
     /**
     * @OA\Get(
     *     path="/api/v1/documents",
     *     tags={"Documents"},
     *     summary="Get User's Documents",
     *     description="Fetches documents by currently logged in user",
     *     operationId="index",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *     security={
     *         {"bearer_token": {}}
     *     },
     * )
     */
    public function index()
    {
        return DocumentsResource::collection(
            Document::where('user_id', Auth::user()->id)->get()
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Post(
     *     path="/api/v1/documents",
     *     tags={"Documents"},
     *     summary="Create a Documents",
     *     operationId="store",

     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     *     security={
     *         {"bearer_token": {}}
     *     },
     *     @OA\RequestBody(
     *         description="Input data format",
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="document_name",
     *                     description="Enter name of the document",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="document_type",
     *                     description="Enter document type",
     *                     type="string"
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function store(StoreDocumentRequest $request)
    {
        $request->validated();

        $documentUrl = 'Documents/document1.pdf';

         

        $document = Document::create([
            'user_id' => Auth::user()->id,
            'document_name' => $request->document_name,
            'document_type' => $request->document_type,
            'document_url' => $documentUrl
        ]);

        return new DocumentsResource($document);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Get(
     *     path="/api/v1/documents/{document}",
     *     tags={"Documents"},
     *     summary="Find document by ID",
     *     description="Returns a single document",
     *     operationId="show",
     *     @OA\Parameter(
     *         name="document",
     *         in="path",
     *         description="ID of document to return",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid ID supplied"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Document not found"
     *     ),
     *     security={
     *         {"bearer_token": {}}
     *     },
     * )
     *
     * @param int $id
     */
    public function show(Document $document)
    {
        return $this->isNotAuthorized($document) ? $this->isNotAuthorized($document) : new DocumentsResource($document);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Patch(
     *     path="/api/v1/documents/{document}",
     *     tags={"Documents"},
     *     summary="Updates a document",
     *     operationId="update",
     *     @OA\Parameter(
     *         name="document",
     *         in="path",
     *         description="ID of document that needs to be updated",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     *     security={
     *         {"bearer_token": {}}
     *     },
     *     @OA\RequestBody(
     *         description="Input data format",
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="document_name",
     *                     description="Updated name of the document",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="document_type",
     *                     description="Updated type of the document",
     *                     type="string"
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function update(Request $request, Document $document)
    {
        if(Auth::user()->id !== $document->user_id) {
            return $this->error('', 'You are not authorized to make this request', 403);
        }

        $document->update($request->only(['document_name', 'document_type']));

        return new DocumentsResource($document);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Delete(
     *     path="/api/v1/documents/{document}",
     *     tags={"Documents"},
     *     summary="Deletes a document",
     *     operationId="destroy",
     *     @OA\Parameter(
     *         name="api_key",
     *         in="header",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="document",
     *         in="path",
     *         description="Document id to delete",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         ),
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid ID supplied",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Document not found",
     *     ),
     *     security={
     *         {"bearer_token": {}}
     *     },
     * )
     */
    public function destroy(Document $document)
    {
        return $this->isNotAuthorized($document) ? $this->isNotAuthorized($document) : $document->delete();
    }

    private function isNotAuthorized($document)
    {
        if(Auth::user()->id !== $document->user_id) {
            return $this->error('', 'You are not authorized to make this request', 403);
        }
    }
}

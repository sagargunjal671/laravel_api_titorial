<?php

namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function home()
    {
        return response()->json(['message' => 'Request GET success']);
    }
    // GET /api/books
    public function index()
    {
        // Get books with pagination (10 books per page)
        $books = Book::paginate(2);
    
        // Return paginated books as JSON
        return response()->json($books);
    }

    // GET /api/books/{id}
    public function show($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        return response()->json($book);
    }

    // POST /api/books
    public function store(Request $request)
    {
        try {
            // Validate input
            $validated = $request->validate([
                'title'       => 'required|string|max:255',
                'author'      => 'required|string|max:255',
                'description' => 'nullable|string|max:255',
            ]);

            // Log the validated data for debugging
            \Log::info('Validated Data:', $validated);

            // Optionally, check the database manually
            if (!empty($validated['description']) && strlen($validated['description']) > 255) {
                return response()->json(['error' => 'Description is too long'], 400);
            }

            // Create book record
            $book = Book::create($validated);

            // Return the created book response
            return response()->json($book, 201);

        } catch (\Exception $e) {
            // Log the exception details
            \Log::error('Error creating book:', ['exception' => $e->getMessage()]);

            // Return a 500 error with the exception message
            return response()->json(['error' => 'An error occurred while creating the book.', 'message' => $e->getMessage()], 500);
        }
    }


    // PUT /api/books/{id}
    public function update(Request $request, $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $validated = $request->validate([
            'title'       => 'sometimes|required|string|max:255',
            'author'      => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $book->update($validated);

        return response()->json($book);
    }

    // DELETE /api/books/{id}
    public function destroy($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $book->delete();

        return response()->json(['message' => 'Book deleted successfully']);
    }
}

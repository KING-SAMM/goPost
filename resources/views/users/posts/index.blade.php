@extends('layout.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            <!-- Iterate though posts after checkong if any exists -->
            @if($posts->count())
                @foreach ($posts as $post)
                    <x-post :post="$post" />
                @endforeach

                {{ $posts->links() }}
            @else
                <p>{{ $user->name }} does not have any posts</p>
            @endif
        </div>
    </div>
@endsection

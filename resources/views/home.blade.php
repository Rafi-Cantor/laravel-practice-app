<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home123</title>
</head>
<body>
    <form action="/logout" method="POST">
        @csrf
        <button>Log out</button>
    </form>
    <div style="border: 3px solid black;">
        <h2>Create post</h2>
        <form action="/create-post" method="POST">
            @csrf
            <input name="title" type="text" placeholder="post title">
            <textarea name="body"  placeholder="body content..."></textarea>
            <button>Create</button>
        </form>
    </div>
    <div style="border: 3px solid black;">
        <h2>All Posts</h2>
            @foreach ($posts as $post)
                <div style="background-color: rgb(172, 172, 172); padding: 10px; margin: 10px;">
                    <h3>{{$post['title']}}</h3>
                    {{$post['body']}}
                    <p><a href="/edit-post/{{$post->id}}">Edit</a></p>
                    <form action="/delete-post/{{$post->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>                    
                    </form>
                </div>
            @endforeach
        </form>
    </div>   
</body>
</html>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
    <title>Document</title>
</head>
<body>
<form method="POST" action="/projects" class="container" style="padding-top: 40px">
    @csrf
    <h1 class="heading is-1">Create a project</h1>
    <div class="field">
        <label class="label" for="title">Title</label>
        <div class="control">
            <input type="text" class="input" name="title" placeholder="title">
        </div>
    </div>
    <div class="field">
        <label class="label" for="description">Description</label>
        <div class="control">
            <textarea name="description" class="textarea"></textarea>
        </div>
    </div>

    <div class="control">
        <button class="button is-link">Submit</button>
    </div>
</form>


</body>
</html>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Todolist</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/reset.css">
  <style>
  </style>
</head>
<body>
  <div class="all">
    <div class="card">
      <div class="top">
        <div class="header">
          <h1 class="title">Todo list</h1>
          <div class="head">
          <p class ="login">「{{$user->name}}」でログイン中</p>
          <form method="post" action="/logout">
            @csrf
          <input class="btn_logout" type="submit" value="ログアウト">
          </form>
          </div>
        </div>
        <a class="btn_search" href="/find">タスク検索</a>
        <form action="/create{task_name,tag_id}" method="post" class="flex">
        @csrf
        <input class="border" type="text" name="task_name">
            <select name="tag_id" class="select-tag">
              @foreach($tags as $tag)
             <option value="{{ $tag->id }}" selected="selected">{{ $tag->tag_name }}</option>
              @endforeach
        <input class="plus" type="submit" name="buttton_task" value="追加">
        @error('task_name')
        <p>{{$message}}</p>
        @enderror
      </form>
       </div>
       <table class="List">
        <tr class="tble">
          <th class="createday">作成日</th>
          <th class="task_date">タスク名</th>
          <th class="tag_tag">タグ</th>
          <th class="kousin">更新</th>
          <th class="sakujyo">削除</th>
        </tr>
        <tr>
        @if ($indexs->isNotEmpty())
        @foreach($indexs as $index)
          <td>{{$index->created_at}}</td>
          <td>
          <form action="/update{{$index->id}}" method="post" class="Upd_form">
            @csrf
            <input class="task" type="text" name="task_name" value={{$index->task_name}}>
          </td>
          <td>
             <select name="tag_id" class="select-tag">
              @foreach($tags as $tag)
                @if ($tag->id === $index->tag_id)
              <option value="{{ $tag->id }}" selected="selected">{{ $tag->tag_name }}</option>
               @else
              <option value="{{$tag->id}}">{{$tag->tag_name}}</option>
              @endif
              @endforeach
            </select>
          <td>
            <button class="upd">更新</button>
          </td>
          </form>
          <td>
            <form action="/delete{{$index->id}}" method="post" >
             @csrf
              <button class="del">削除</button>
            </form>
          </td>
          </tr>
         @endforeach
        @endif
      </table>
    </div>
  </div>
</body>
</html>

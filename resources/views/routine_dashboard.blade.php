@extends('layout')
@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      body {
        background: linear-gradient(135deg, #f3f4f6, #e3e5e8);
        font-family: 'Arial', sans-serif;
      }
      .welcome-header {
        margin-top: 200px;
        color: #008000;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
      }
    </style>
  </head>
  <body>
    <!-- Main Content -->
    <div class="container text-center">
      <h1 class="display-4 welcome-header">Welcome to Your Dashboard</h1>
      <p class="lead mt-3" style="color: #383838;">From here you can create your routine or download a routine as per your needs.</p>
    </div>
  </body>
@endsection

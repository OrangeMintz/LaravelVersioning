<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Head section -->
</head>
<body>
    <div>
        <h1>Hello World V2</h1>

        <!-- Update Button -->
        <form method="POST" action="{{ route('update.welcome') }}">
            @csrf
            <button type="submit">Update to 1.0.1</button>
        </form>

        <!-- Rollback Button -->
        <form method="POST" action="{{ route('rollback.welcome') }}">
            @csrf
            <button type="submit">Rollback to 1.0.0</button>
        </form>
    </div>
</body>
</html>

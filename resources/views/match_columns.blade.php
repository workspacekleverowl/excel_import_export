<!DOCTYPE html>
<html>
<head>
    <title>Match Columns</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2>Match Columns</h2>
    <form action="{{ route('orders.import') }}" method="POST">
        @csrf
        <input type="hidden" name="file_path" value="{{ $filePath }}">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Database Column</th>
                <th>Excel Column</th>
            </tr>
            </thead>
            <tbody>
            @foreach($headings as $heading)
                <tr>
                    <td>{{ $heading }}</td>
                    <td>
                        <select name="columns[{{ $heading }}]" class="form-control" required>
                            @foreach($headings as $header)
                                <option value="{{ $header }}">{{ $header }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Import</button>
    </form>
</div>
</body>
</html>

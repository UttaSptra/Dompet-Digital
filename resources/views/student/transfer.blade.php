<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Transfer</title>
</head>
<body>

    <h2>Form Transfer Antar Siswa</h2>

    <form method="POST" action="/transfer">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    
    <label>Dari Rekening:</label>
    <input type="text" name="from_account" required>

    <label>Ke Rekening:</label>
    <input type="text" name="to_account" required>

    <label>Jumlah Transfer:</label>
    <input type="number" name="amount" required>

    <button type="submit">Transfer</button>
</form>


</body>
</html>



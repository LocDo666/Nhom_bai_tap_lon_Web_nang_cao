<h2 style="text-align:center;">📚 DANH SÁCH SÁCH TRONG THƯ VIỆN</h2>
<table border="1" cellspacing="0" cellpadding="5" width="100%">
    <thead style="background:#400000; color:white;">
        <tr>
            <th>ID</th>
            <th>Tên sách</th>
            <th>Tác giả</th>
            <th>NXB</th>
            <th>Năm</th>
        </tr>
    </thead>
    <tbody>
        @foreach($books as $book)
        <tr>
            <td>{{ $book->id }}</td>
            <td>{{ $book->title }}</td>
            <td>{{ $book->author }}</td>
            <td>{{ $book->publisher }}</td>
            <td>{{ $book->year }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

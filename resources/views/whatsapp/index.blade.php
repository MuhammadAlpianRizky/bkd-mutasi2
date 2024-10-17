<div class="container-fluid">
    <form action="{{ route('wagw.send') }}" method="post">
        @csrf
        <input type="text" name="pesan" placeholder="pesan" required>
        <input type="text" name="nowa" placeholder="nowa" required>
        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>
</div>

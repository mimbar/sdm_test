<script>
    Noty.overrideDefaults({
        theme: 'limitless',
        layout: 'topRight',
        type: 'alert',
        timeout: 2800
    });

    @if(session('createStatus')['code'] === 200)
    new Noty({
        theme: ' alert bg-success text-white alert-styled-left p-0',
        text: 'Data Berhasil ditambah. {{ session('createStatus')['message'] }}',
        type: 'success',
        progressBar: true,
    }).show();
    @elseif(session('createStatus')['code'] === 500)
    new Noty({
        theme: ' alert bg-danger text-white alert-styled-left p-0',
        text: "{!! session('createStatus')['message'] !!}",
        type: 'danger',
        progressBar: true,
    }).show();
    @endif

    @if(session('updateStatus')['code'] === 200)
    new Noty({
        theme: ' alert bg-success text-white alert-styled-left p-0',
        text: 'Data Berhasil disunting.',
        type: 'success',
        progressBar: true,
    }).show();
    @elseif(session('updateStatus')['code'] === 500)
    new Noty({
        theme: ' alert bg-danger text-white alert-styled-left p-0',
        text: "{!! session('updateStatus')['message'] !!}",
        type: 'danger',
        progressBar: true,
    }).show();
    @endif

    @if(session('deleteStatus')['code'] === 200)
    new Noty({
        theme: ' alert bg-success text-white alert-styled-left p-0',
        text: 'Data Berhasil dihapus.',
        type: 'success',
        progressBar: true,
    }).show();
    @elseif(session('deleteStatus')['code'] === 500)
    new Noty({
        theme: ' alert bg-danger text-white alert-styled-left p-0',
        text: "{!! session('deleteStatus')['message'] !!}",
        type: 'danger',
        progressBar: true,
    }).show();
    @endif


</script>
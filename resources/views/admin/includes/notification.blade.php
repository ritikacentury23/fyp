@if(session('success'))

<div id="success-alert" class="alert alert-success position-fixed top-0 end-0 m-4 shadow" role="alert"
    style="z-index: 1055;">
    {{ session('success') }}
</div>

<script>
setTimeout(function() {
    let alert = document.getElementById('success-alert');
    if (alert) {
        alert.classList.add('fade');
        setTimeout(() => alert.remove(), 500);
    }
}, 3000);
</script>
@endif

@if(session('error'))
    <div id="error-alert" class="alert alert-danger position-fixed top-0 end-0 m-4 shadow" role="alert" style="z-index: 1055;">
        {{ session('error') }}
    </div>

    <script>
    setTimeout(function() {
        let alert = document.getElementById('error-alert');
        if (alert) {
            alert.classList.add('fade');
            setTimeout(() => alert.remove(), 500);
        }
    }, 3000);
    </script>
@endif




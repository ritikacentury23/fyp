@if(session('success'))
<div id="front-success-alert" style="
    position: fixed;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 9999;
    min-width: 320px;
    max-width: 500px;
    background: #7fba00;
    color: #fff;
    padding: 14px 24px;
    border-radius: 6px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 15px;
    font-weight: 500;
    transition: opacity 0.5s ease;
">
    <i class="fa fa-check-circle" style="font-size:18px;flex-shrink:0;"></i>
    <span>{{ session('success') }}</span>
</div>
<script>
setTimeout(function () {
    var el = document.getElementById('front-success-alert');
    if (el) { el.style.opacity = '0'; setTimeout(function(){ el.remove(); }, 500); }
}, 3000);
</script>
@endif

@if(session('error'))
<div id="front-error-alert" style="
    position: fixed;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 9999;
    min-width: 320px;
    max-width: 500px;
    background: #e53935;
    color: #fff;
    padding: 14px 24px;
    border-radius: 6px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 15px;
    font-weight: 500;
    transition: opacity 0.5s ease;
">
    <i class="fa fa-times-circle" style="font-size:18px;flex-shrink:0;"></i>
    <span>{{ session('error') }}</span>
</div>
<script>
setTimeout(function () {
    var el = document.getElementById('front-error-alert');
    if (el) { el.style.opacity = '0'; setTimeout(function(){ el.remove(); }, 500); }
}, 3500);
</script>
@endif

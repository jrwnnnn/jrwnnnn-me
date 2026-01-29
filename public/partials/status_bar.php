<div class="flex fixed top-0 left-0 z-40 justify-between items-center py-1 px-5 w-full text-xs border-b border-green-800 bg-green-900/20 backdrop-blur-sm">
    <div class="flex gap-4">
        <span>[ CONNECTED ]</span>
        <span>USER: GUEST</span>
    </div>
    <div>
        <span id="live-clock"></span>
        <script>
            function updateTime() {
                const now = new Date();
                const timeString = now.toLocaleTimeString([], { hour12: false });
                document.getElementById('live-clock').textContent = timeString;
            }
            updateTime();
            setInterval(updateTime, 1000);
        </script>
    </div>
</div>
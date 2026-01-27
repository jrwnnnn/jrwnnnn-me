<div class="fixed top-0 left-0 w-full bg-green-900/20 border-b border-green-800 text-xs px-5 py-1 flex justify-between items-center z-40 backdrop-blur-sm">
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
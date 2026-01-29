<footer class="mt-20 mb-10 text-center text-green-500">
    <p>--- END OF LINE ---</p>
    <p>&copy; <?php echo date("Y"); ?> JRWNNNN_</p>
</footer>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const mainElements = document.querySelectorAll("main > *");
        mainElements.forEach((el, index) => {
            el.classList.add("animate-pop-in");
            el.style.animationDelay = `${index * 100}ms`;
        });
    });
</script>
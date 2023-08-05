
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>


        function toggleMenu() {
            const listsElement = document.querySelector('.lists');
            const displayStyle = window.getComputedStyle(listsElement).display;
            const menuIcon = document.getElementById('menu-icon');

            if (displayStyle === 'none') {
                listsElement.style.display = 'block';
                menuIcon.setAttribute('name', 'chevron-forward-sharp');
            } else {
                listsElement.style.display = 'none';
                menuIcon.setAttribute('name', 'chevron-back-sharp');
            }
        }



        // const menu = document.querySelectorAll('.menu');


        function toggle() {
            const leftSection = document.querySelector('.left-section');
            const rightSection = document.querySelector('.right-section');
            const toggleBtn = document.getElementById('toggleBtn');
            const text = document.querySelectorAll('.none');


            // Toggle CSS classes on the left-section element
            leftSection.classList.toggle('collapsed');
            rightSection.classList.toggle('collaspedright');


            text.forEach(span => {
                span.style.display = leftSection.classList.contains('collapsed') ? 'none' : 'block';


            });

            const iconElement = document.getElementById('iconElement');

            if (iconElement.getAttribute('name') === 'chevron-back-sharp') {
                iconElement.setAttribute('name', 'chevron-forward-sharp');
            } else {
                iconElement.setAttribute('name', 'chevron-back-sharp');
            }



        }

    </script>
</body>

</html>
        </div>
    </div>
    <script src="js/admin-app.js"></script>
    <script>
        document.getElementById('logout-btn')?.addEventListener('click', () => {
            localStorage.clear();
            window.location.href = '../store-web/login.php';
        });
    </script>
</body>
</html>

    <script src="vendor/components/jquery/jquery.min.js"></script>
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script>
        $("#accessTokenMenu").find('.btn-copy').click(function() {
            $(this).closest('div').find('input').select();
            document.execCommand('copy');
        });
        $("#refreshTokenMenu").find('.btn-copy').click(function() {
            $(this).closest('tr').find('.token-full').select();
            document.execCommand('copy');
        });
    </script>
    <script src="public/js/banner.js"></script>
</body>
</html>
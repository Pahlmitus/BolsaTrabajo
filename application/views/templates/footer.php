</div> <!-- #main -->
<footer id="footer">
        <div id="social">
                <i class="fa fa-twitter-square"></i>
                <i class="fa fa-facebook-square"></i>
                <i class="fa fa-google-plus-square"></i>
        </div>
        <div id="footer-links">Preguntas |  Contacto |  Privacidad |  Terminos |  Asociación</div>
        <div id="copyright">Copyright © <?php echo date("Y");?></div>
</footer>

<!-- Carga los scripts -->
<?php if (!!$js_files) { foreach($js_files as $file): ?>
    <script src="<?php echo $file; ?>"></script>
<?php endforeach; } ?>

</body>
</html>
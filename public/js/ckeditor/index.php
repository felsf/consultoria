<script src="ckeditor.js"></script>

<body>
	 <form action="" method="POST"> 
            <textarea name="texto" id="editor1" rows="10" cols="80">
                This is my textarea to be replaced with CKEditor.
            </textarea>
            <script>                
                CKEDITOR.replace( 'editor1' );
            </script>
			<button type="submit">Teste</button>
        </form>
		
		<hr>
		
		<?php if(isset($_POST['texto'])): ?>
			Texto Digitado: <?php echo htmlspecialchars($_POST['texto']); ?>
		<?php endif; ?>
		
</body>
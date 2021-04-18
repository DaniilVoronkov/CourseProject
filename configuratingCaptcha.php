<?php 
//defining public site key
    define("SITEKEY", "6Ld72aIaAAAAAL1gWwx7i3tp2JGYqvOL-H5HLVoe");
    //defining secret key
    define("SECRETKEY", "6Ld72aIaAAAAAP6H37ZYElPpjHy_QdarrsvRLNOW");
?>

<script src="https://www.google.com/recaptcha/api.js?render=<?= SITEKEY ?>"></script>
        <script>
            grecaptcha.ready(() => {
                grecaptcha.execute("<?= SITEKEY ?>", { action: "Create" })
                .then(token => document.querySelector("#recaptchaResponse").value = token)
                .catch(error => console.error(error));
            });
        </script>
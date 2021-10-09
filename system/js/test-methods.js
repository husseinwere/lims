$(document).ready(()=>{
    loadTestMethods()

    function loadTestMethods(){
        $('#test-methods').load('includes/test-methods.inc.php')
    }
})
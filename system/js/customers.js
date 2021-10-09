$(document).ready(()=>{
    loadCustomers()

    function loadCustomers(){
        $('#customers').load('includes/customers.inc.php')
    }
})
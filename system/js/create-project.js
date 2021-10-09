$(document).ready(()=>{
    $('#payment').change(()=>{
        if($('#payment').val() == "Yes"){
            $('#amount_charged').removeAttr('disabled')
            $('#receipt_no').removeAttr('disabled')
        }
        else {
            $('#amount_charged').val('')
            $('#receipt_no').val('')
            $('#amount_charged').attr('disabled', 'true')
            $('#receipt_no').attr('disabled', 'true')
        }
    })

    //LOAD CUSTOMERS
    $.ajax({
        type: 'GET',
        url: 'includes/get-customers.inc.php',
        success: (data)=>{
            data = JSON.parse(data);
            if(data.message == 'success'){
                $('#customer').append(data.customers)
            }
            else {
                $('#errors').html("An error has occurred while loading customers. Please refresh.")
            }
        },
        error: ()=>{
            $('#errors').html("An error has occurred while loading customers. Please refresh.")
        }
    })

    //CREATE PROJECT
    $('#createproject').submit((e)=>{
        e.preventDefault()

        $('#createprojectbtn').attr('disabled', 'true')
        
        $('#dynamic_form').remove()
        $('#errors').html("")

        customer = $('#customer').val()
        amount_charged = $('#amount_charged').val()
        receipt_no = $('#receipt_no').val()
        sample_amount = $('#sample_amount').val()
        report_format = $('#report_format').val()
        results_dispatch = $('#results_dispatch').val()

        if(!customer || customer == "--SELECT--") {
            $('#errors').html("Please select a customer")
        }
        else {
            $(
                `
                <form id="dynamic_form">
                    <input name="customer" type="text" value="${customer}">
                    <input name="report_format" type="text" value="${report_format}">
                    <input name="results_dispatch" type="text" value="${results_dispatch}">
                    <input name="sample_amount" type="text" value="${sample_amount}">
                    <input name="amount_charged" type="text" value="${amount_charged}">
                    <input name="receipt_no" type="text" value="${receipt_no}">
                    <input type="submit" name="login-submit" value="submit">
                </form>
                `
            ).appendTo('body');
            $('#dynamic_form').submit((e)=>{
                e.preventDefault()
                $.ajax({
                    type: 'POST',
                    url: 'includes/create-project.inc.php',
                    data: $('#dynamic_form').serialize(), 
                    success: (data)=>{
                        $('#createprojectbtn').removeAttr('disabled')
                        data = JSON.parse(data);
                        if(data.message == 'success'){
                            window.location.href = 'project.php?p=' + data.id
                        }
                        else if(data.message == 'nocustomer'){
                            $('#errors').html("Please select a customer")
                        }
                        else {
                            $('#errors').html("An error has occurred. Please try again.")
                        }
                    },
                    error: ()=>{
                        $('#createprojectbtn').removeAttr('disabled')
                        $('#errors').html("An error has occurred. Please try again.")
                    }
                })
            })
            $('#dynamic_form').submit()
        }
    })
})
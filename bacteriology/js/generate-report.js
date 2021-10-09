$(document).ready(()=>{
    $('#generatereportbtn').click(()=>{
        $('#generatereport').submit()
    })
    $('#generatereport').submit((e)=>{
        e.preventDefault()

        $('#generatereportbtn').attr('disabled', 'true')
        
        $('#dynamic_form').remove()
        $('#errors').html("")

        folio = $('#folio').val()
        rebody = $('#rebody').val()
        labs = $('#labsPresent').val()
        labCount = labs.split(',').length
        method_descriptions = []
        for(let i=0; i<labCount; i++)
            method_descriptions.push($('#l'+i).val())
        console.log(method_descriptions)
        observations = $('#observations').val()
        charges = $('#charges').val()
        invoice = $('#invoice').val()
        analysed_by = $('#analysed_by').val()

        if(!folio || !rebody || !labs || !method_descriptions || !observations || !charges || !invoice || !analysed_by) {
            $('#generatereportbtn').removeAttr('disabled')
            $('#errors').html("Please fill in all fields")
        }
        else {
            $(
                `
                <form id="dynamic_form">
                    <input name="folio" type="text" value="${folio}">
                    <input name="rebody" type="text" value="${rebody}">
                    <input name="labs" type="text" value="${labs}">
                    <input name="method_descriptions" type="text" value="${method_descriptions.toString()}">
                    <input name="observations" type="text" value="${observations}">
                    <input name="charges" type="text" value="${charges}">
                    <input name="invoice" type="text" value="${invoice}">
                    <input name="analysed_by" type="text" value="${analysed_by}">
                    <input type="submit" name="login-submit" value="submit">
                </form>
                `
            ).appendTo('body');
            $('#dynamic_form').submit((e)=>{
                e.preventDefault()
                $.ajax({
                    type: 'POST',
                    url: 'includes/generate-report.inc.php?p=' + getUrlVars().p,
                    data: $('#dynamic_form').serialize(), 
                    success: (data)=>{
                        $('#generatereportbtn').removeAttr('disabled')
                        data = JSON.parse(data);
                        if(data.message == 'success'){
                            toastr.success("Report downloading...")
                            setTimeout(()=>{
                                window.open(
                                    'crf/' + data.url,
                                    '_blank' // <- This is what makes it open in a new window.
                                  );
                            }, 1000)
                        }
                        else {
                            $('#errors').html("An error has occurred. Please try again.")
                        }
                    },
                    error: ()=>{
                        $('#generatereportbtn').removeAttr('disabled')
                        $('#errors').html("An error has occurred. Please try again.")
                    }
                })
            })
            $('#dynamic_form').submit()
        }
    })

    function getUrlVars()
    {
        let vars = [], hash;
        let hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for(let i = 0; i < hashes.length; i++)
        {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars;
    }
})
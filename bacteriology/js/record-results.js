$(document).ready(()=>{
    $('#recordresults').submit((e)=>{
        e.preventDefault()

        $('#recordresultsbtn').attr('disabled', 'true')
        
        $('#dynamic_form').remove()
        $('#errors').html("")

        results = $('#results').val()

        if(!results) {
            $('#errors').html("Please fill in all required fields")
        }
        else {
            $(
                `
                <form id="dynamic_form">
                    <input name="results" type="text" value="${results}">
                    <input type="submit" name="login-submit" value="submit">
                </form>
                `
            ).appendTo('body');
            $('#dynamic_form').submit((e)=>{
                e.preventDefault()
                $.ajax({
                    type: 'POST',
                    url: 'includes/record-results.inc.php?t='+getUrlVars().t,
                    data: $('#dynamic_form').serialize(), 
                    success: (data)=>{
                        $('#recordresultsbtn').removeAttr('disabled')
                        data = JSON.parse(data);
                        if(data.message == 'success'){
                            window.location.href = 'project.php?p=' + data.project
                        }
                        else {
                            $('#errors').html("An error has occurred. Please try again.")
                        }
                    },
                    error: ()=>{
                        $('#recordresultsbtn').removeAttr('disabled')
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
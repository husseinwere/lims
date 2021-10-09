$(document).ready(()=>{
    //LOAD LABS
    $.ajax({
        type: 'GET',
        url: 'includes/get-labs.inc.php',
        success: (data)=>{
            data = JSON.parse(data);
            if(data.message == 'success'){
                $('#labs').append(data.labs)
            }
            else {
                $('#errors').html("An error has occurred while loading labs. Please refresh.")
            }
        },
        error: ()=>{
            $('#errors').html("An error has occurred while loading labs. Please refresh.")
        }
    })

    //LOG SAMPLE
    $('#logsample').submit((e)=>{
        e.preventDefault()

        $('#logsamplebtn').attr('disabled', 'true')
        
        $('#dynamic_form').remove()
        $('#errors').html("")

        ref_no = $('#ref_no').val()
        date_sampled = $('#date_sampled').val()
        date_received = $('#date_received').val()
        sampled_by = $('#sampled_by').val()
        sample_variety = $('#sample_variety').val()
        sample_type = $('#sample_type').val()
        sample_origin = $('#sample_origin').val()
        sample_description = $('#sample_description').val()
        sample_size = $('#sample_size').val()
        sample_condition = $('#sample_condition').val()
        part_submitted = $('#part_submitted').val()
        sampling_bag = $('#sampling_bag').val()
        additional_info = $('#additional_info').val()
        test_methods = []
        $('input[name="test_methods"]:checked').each(function() {
            test_methods.push(this.value);
        });

        if(!ref_no || !date_received || !sample_condition || !sampled_by || !test_methods) {
            $('#errors').html("Please fill in all required fields")
        }
        else {
            $(
                `
                <form id="dynamic_form">
                    <input name="project" type="text" value="${getUrlVars().p}">
                    <input name="ref_no" type="text" value="${ref_no}">
                    <input name="sampled_by" type="text" value="${sampled_by}">
                    <input name="date_sampled" type="text" value="${date_sampled}">
                    <input name="date_received" type="text" value="${date_received}">
                    <input name="sample_variety" type="text" value="${sample_variety}">
                    <input name="sample_type" type="text" value="${sample_type}">
                    <input name="sample_origin" type="text" value="${sample_origin}">
                    <input name="sample_description" type="text" value="${sample_description}">
                    <input name="sample_size" type="text" value="${sample_size}">
                    <input name="sample_condition" type="text" value="${sample_condition}">
                    <input name="part_submitted" type="text" value="${part_submitted}">
                    <input name="sampling_bag" type="text" value="${sampling_bag}">
                    <input name="additional_info" type="text" value="${additional_info}">
                    <input name="test_methods" type="text" value="${test_methods.toString()}">
                    <input type="submit" name="login-submit" value="submit">
                </form>
                `
            ).appendTo('body');
            $('#dynamic_form').submit((e)=>{
                e.preventDefault()
                $.ajax({
                    type: 'POST',
                    url: 'includes/log-sample.inc.php',
                    data: $('#dynamic_form').serialize(), 
                    success: (data)=>{
                        $('#logsamplebtn').removeAttr('disabled')
                        data = JSON.parse(data);
                        if(data.message == 'sampleexists'){
                            $('#errors').html("The sample ref/lot no you entered already exists.")
                        }
                        else if(data.message == 'success'){
                            window.location.href = 'project.php?p=' + getUrlVars().p
                        }
                        else {
                            $('#errors').html("An error has occurred. Please try again.")
                        }
                    },
                    error: ()=>{
                        $('#logsamplebtn').removeAttr('disabled')
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
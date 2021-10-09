$(document).ready(()=>{
    $('#deletesample').click((e)=>{
        e.preventDefault()

        if(window.confirm("Please confirm deletion of this sample")){
            $.ajax({
                type: 'GET',
                url: 'includes/delete-sample.inc.php?s=' + getUrlVars().s + '&l=' + getUrlVars().l,
                success: (data)=>{
                    data = JSON.parse(data)
                    if(data.message == 'success'){
                        toastr.success('Sample deleted successfully')
                    }
                }
            })
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
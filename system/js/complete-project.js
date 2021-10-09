$(document).ready(()=>{
    loadSamples()

    $('#contract-review').click(()=>{
        $.ajax({
            type: 'GET',
            url: 'includes/download-contract-review.inc.php?p='+getUrlVars().p,
            success: (data)=>{
                data = JSON.parse(data);
                if(data.message == 'success'){
                    toastr.success("Your file is downloading...")
                    setTimeout(()=>{
                        window.open(
                            'crf/' + data.url,
                            '_blank' // <- This is what makes it open in a new window.
                          );
                    }, 1000)
                }
                else {
                    toastr.error("Error downloading contract review")
                }
            },
            error: ()=>{
                toastr.error("Error downloading contract review")
            }
        })    
    })

    $('#deleteproject').click(()=>{
        if(window.confirm("This project and all samples related to it will be permanently deleted. Proceed?")){
            $.ajax({
                type: 'GET',
                url: 'includes/delete-project.inc.php?p='+getUrlVars().p,
                success: (data)=>{
                    data = JSON.parse(data);
                    if(data.message == 'success'){
                        toastr.success("Project deleted successfully")
                    }
                    else {
                        toastr.error("Error deleting project")
                    }
                },
                error: ()=>{
                    toastr.error("Error deleting project")
                }
            })
        } 
    })

    function loadSamples(){
        $('#samples').load('includes/complete-samples.inc.php?p=' + getUrlVars().p)
    }

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
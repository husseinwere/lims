$(document).ready(()=>{
    loadProjects()

    function loadProjects(){
        $('#projects').load('includes/complete-projects.inc.php')
    }
})
$(document).ready(()=>{
    loadProjects()

    function loadProjects(){
        $('#projects').load('includes/projects.inc.php')
    }
})
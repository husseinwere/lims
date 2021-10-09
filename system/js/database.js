$(document).ready(()=>{
    $('#consolidateddb').click((e)=>{
        e.preventDefault()

        if(window.confirm('Download CONSOLIDATED database?')){
            $('#consolidateddb').html('<img src=img/35.gif class=button-loader>')
            $.ajax({
                type: 'GET',
                url: 'includes/consolidated_db.inc.php',
                success: (data)=>{
                    data = JSON.parse(data)
                    if(data.message == 'success'){
                        $('.dataTable').remove()
                        $('#tableCarrier').append(data.data)
                        
                        var exportType = $(this).data('type');		
                        $('.dataTable').tableExport({
                            type : exportType,			
                            escape : 'false',
                            ignoreColumn: []
                        })
                        $('#consolidateddb').html('Export database')
                        toastr.info('Downloading database')
                        $('.button-default.csv').click()
                    }
                }
            })
        }
    })

    $('#moleculardb').click((e)=>{
        e.preventDefault()

        if(window.confirm('Download MOLECULAR database?')){
            $('#moleculardb').html('<img src=img/35.gif class=button-loader>')
            $.ajax({
                type: 'GET',
                url: 'includes/molecular_db.inc.php',
                success: (data)=>{
                    data = JSON.parse(data)
                    if(data.message == 'success'){
                        $('.dataTable').remove()
                        $('#tableCarrier').append(data.data)
                        
                        var exportType = $(this).data('type');		
                        $('.dataTable').tableExport({
                            type : exportType,			
                            escape : 'false',
                            ignoreColumn: []
                        })
                        $('#moleculardb').html('Export database')
                        toastr.info('Downloading database')
                        $('.button-default.csv').click()
                    }
                }
            })
        }
    })

    $('#bacteriologydb').click((e)=>{
        e.preventDefault()

        if(window.confirm('Download BACTERIOLOGY database?')){
            $('#bacteriologydb').html('<img src=img/35.gif class=button-loader>')
            $.ajax({
                type: 'GET',
                url: 'includes/bacteriology_db.inc.php',
                success: (data)=>{
                    data = JSON.parse(data)
                    if(data.message == 'success'){
                        $('.dataTable').remove()
                        $('#tableCarrier').append(data.data)
                        
                        var exportType = $(this).data('type');		
                        $('.dataTable').tableExport({
                            type : exportType,			
                            escape : 'false',
                            ignoreColumn: []
                        })
                        $('#bacteriologydb').html('Export database')
                        toastr.info('Downloading database')
                        $('.button-default.csv').click()
                    }
                }
            })
        }
    })

    $('#entomologydb').click((e)=>{
        e.preventDefault()

        if(window.confirm('Download ENTOMOLOGY database?')){
            $('#entomologydb').html('<img src=img/35.gif class=button-loader>')
            $.ajax({
                type: 'GET',
                url: 'includes/entomology_db.inc.php',
                success: (data)=>{
                    data = JSON.parse(data)
                    if(data.message == 'success'){
                        $('.dataTable').remove()
                        $('#tableCarrier').append(data.data)
                        
                        var exportType = $(this).data('type');		
                        $('.dataTable').tableExport({
                            type : exportType,			
                            escape : 'false',
                            ignoreColumn: []
                        })
                        $('#entomologydb').html('Export database')
                        toastr.info('Downloading database')
                        $('.button-default.csv').click()
                    }
                }
            })
        }
    })

    $('#mycologydb').click((e)=>{
        e.preventDefault()

        if(window.confirm('Download MYCOLOGY database?')){
            $('#mycologydb').html('<img src=img/35.gif class=button-loader>')
            $.ajax({
                type: 'GET',
                url: 'includes/mycology_db.inc.php',
                success: (data)=>{
                    data = JSON.parse(data)
                    if(data.message == 'success'){
                        $('.dataTable').remove()
                        $('#tableCarrier').append(data.data)
                        
                        var exportType = $(this).data('type');		
                        $('.dataTable').tableExport({
                            type : exportType,			
                            escape : 'false',
                            ignoreColumn: []
                        })
                        $('#mycologydb').html('Export database')
                        toastr.info('Downloading database')
                        $('.button-default.csv').click()
                    }
                }
            })
        }
    })

    $('#nematologydb').click((e)=>{
        e.preventDefault()

        if(window.confirm('Download NEMATOLOGY database?')){
            $('#nematologydb').html('<img src=img/35.gif class=button-loader>')
            $.ajax({
                type: 'GET',
                url: 'includes/nematology_db.inc.php',
                success: (data)=>{
                    data = JSON.parse(data)
                    if(data.message == 'success'){
                        $('.dataTable').remove()
                        $('#tableCarrier').append(data.data)
                        
                        var exportType = $(this).data('type');		
                        $('.dataTable').tableExport({
                            type : exportType,			
                            escape : 'false',
                            ignoreColumn: []
                        })
                        $('#nematologydb').html('Export database')
                        toastr.info('Downloading database')
                        $('.button-default.csv').click()
                    }
                }
            })
        }
    })

    $('#virologydb').click((e)=>{
        e.preventDefault()

        if(window.confirm('Download VIROLOGY database?')){
            $('#virologydb').html('<img src=img/35.gif class=button-loader>')
            $.ajax({
                type: 'GET',
                url: 'includes/virology_db.inc.php',
                success: (data)=>{
                    data = JSON.parse(data)
                    if(data.message == 'success'){
                        $('.dataTable').remove()
                        $('#tableCarrier').append(data.data)
                        
                        var exportType = $(this).data('type');		
                        $('.dataTable').tableExport({
                            type : exportType,			
                            escape : 'false',
                            ignoreColumn: []
                        })
                        $('#virologydb').html('Export database')
                        toastr.info('Downloading database')
                        $('.button-default.csv').click()
                    }
                }
            })
        }
    })

    $('#tissueculturedb').click((e)=>{
        e.preventDefault()

        if(window.confirm('Download TISSUE CULTURE database?')){
            $('#tissueculturedb').html('<img src=img/35.gif class=button-loader>')
            $.ajax({
                type: 'GET',
                url: 'includes/tissue_culture_db.inc.php',
                success: (data)=>{
                    data = JSON.parse(data)
                    if(data.message == 'success'){
                        $('.dataTable').remove()
                        $('#tableCarrier').append(data.data)
                        
                        var exportType = $(this).data('type');		
                        $('.dataTable').tableExport({
                            type : exportType,			
                            escape : 'false',
                            ignoreColumn: []
                        })
                        $('#tissueculturedb').html('Export database')
                        toastr.info('Downloading database')
                        $('.button-default.csv').click()
                    }
                }
            })
        }
    })

    $('#customersdb').click((e)=>{
        e.preventDefault()

        if(window.confirm('Download CUSTOMERS database?')){
            $('#customersdb').html('<img src=img/35.gif class=button-loader>')
            $.ajax({
                type: 'GET',
                url: 'includes/customers_db.inc.php',
                success: (data)=>{
                    data = JSON.parse(data)
                    if(data.message == 'success'){
                        $('.dataTable').remove()
                        $('#tableCarrier').append(data.data)
                        
                        var exportType = $(this).data('type');		
                        $('.dataTable').tableExport({
                            type : exportType,			
                            escape : 'false',
                            ignoreColumn: []
                        })
                        $('#customersdb').html('Export database')
                        toastr.info('Downloading database')
                        $('.button-default.csv').click()
                    }
                }
            })
        }
    })
})
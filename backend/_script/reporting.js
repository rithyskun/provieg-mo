function reporting(repAjax) {
    var oThis = this;
    this.oldHeight;
    this.oldMargin;
    this.repAjax = repAjax;
    this.show = function() {
        $('#reporting_msg').fadeOut('normal');
        $('#footer_nav').fadeOut('normal', function() { ;
            oThis.oldHeight = $('#footer').css('height');
            oThis.oldMargin = $('#page').css('margin-bottom');
            $('#footer').css('height', '8em');
            $('#push').css('height', '8em');
            $('#page').css('margin-bottom', '-8em');
            window.scrollBy(0,300);
            $('#reporting_form').fadeIn('normal', function() { $('#reporting_form > textarea').focus(); });
        });
    }
    this.hide = function() {
        $('#reporting_form').fadeOut('normal', function() {
             $('#footer').css('height', oThis.oldHeight);
             $('#push').css('height', oThis.oldHeight);
             $('#page').css('margin-bottom', oThis.oldMargin);
             $('#reporting_form > textarea').val('');
             $('#footer_nav').fadeIn('high');
             $('#reporting_msg').fadeIn('slow');
        });
    }
}	           



$(document).ready(function() {
    
    // cache le formulaire
    $('#reporting_form').toggle();
    $('#reporting_msg').toggle();
    
    // bind la touche annuler pour cacher le formulaire 
    $('#report_btn_annuler')
        .click(function() {
            oReporting.hide();
        });
    
    // bind le span demande pour afficher le formulaire dans le cas d'un problème
    $('#btn_probleme')
        .click(function() { 
            oReporting.show();            
            $('#reporting_form > p').html("Veuillez indiquer le problème que vous avez rencontré");
            $('#reporting_form').attr('action', oReporting.repAjax+'reporting/reporting_probleme_ajout.php');
            $('#report_btn_valid')
                .unbind('click')
                .click(function() {
                    oReporting.hide();
                    $('#reporting_msg').fadeIn('normal');
                });
        })
        .mouseover(function() { $(this).css("text-decoration", "underline"); })
        .mouseout(function()  { $(this).css("text-decoration", "none"); })
        .css("cursor", "pointer");
    
    // bind le span demande pour afficher le formulaire dans le cas d'une demande
    $('#btn_demande')
        .click(function() {
            oReporting.show();
            $('#reporting_form > p').html("Veuillez indiquer ce que vous souhaitez voir ajouté");
            $('#reporting_form').attr('action', oReporting.repAjax+'reporting/reporting_demande_ajout.php');
            $('#report_btn_valid')
                .unbind('click')
                .click(function() {                
                    oReporting.hide();
                });
        })
        .mouseover(function() { $(this).css("text-decoration", "underline"); })
        .mouseout(function()  { $(this).css("text-decoration", "none"); })
        .css("cursor", "pointer");

    // prépare le formulaire de reporting aux requetes AJAX
    $('#reporting_form').ajaxForm({
        target: "#reporting_msg"
    }); 
});

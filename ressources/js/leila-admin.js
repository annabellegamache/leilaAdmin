document.querySelectorAll('.btn-modifier, .btn-supprimer').forEach(function(btn) {
    btn.addEventListener('click', function() {
        if(this.className.indexOf('supprimer') != -1) {
            this.closest('form').action += '/retirer';
        }
        else if(this.className.indexOf('modifier') != -1) {
            this.closest('form').action += '/changer';
        }
    });
});
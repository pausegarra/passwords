'use strict'

window.onload = () => {
    window.livewire.on('showPassword', password => {
        Swal.fire({
            title           : 'Contraseña',
            text            : password,
            timer           : 5000,
            timerProgressBar: true
        })
    })

    window.livewire.on('askMembers', (groupDn, index) => {
        Swal.fire({
            title: 'Procesando',
            text: 'Porfavor espera',
            willOpen: () => {
                Swal.showLoading()
            }
        })
        Livewire.emit('getMembers', groupDn, index)
    })

    window.livewire.on('showMembers', (data) => {
        let html = ""
        for(let member of data['members']) html += "<p>" + member + "</p>"
        Swal.fire({
            title: 'Miembros de ' + data['groupName'],
            position: 'top',
            html: html
        })
    })
}
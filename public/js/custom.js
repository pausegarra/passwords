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
            text : 'Porfavor espera',
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
            title   : 'Miembros de ' + data['groupName'],
            position: 'top',
            html    : html
        })
    })

    window.livewire.on('generatePassword', () => {
        Swal.fire({
            title           : 'Generador de contraseñas',
            text            : 'Introduce una longitude de contraseña',
            input           : 'text',
            showCancelButton: true,
        }).then((res) => {
            if(res.isConfirmed) {
                if(res.value.length == 0) res.value = 16
                Livewire.emit('genPassword', res.value)
            }
        })
    })

    window.livewire.on('showNewGroupInfo', () => {
        Swal.fire({
            title: 'Información para nuevo grupo',
            text : 'Para solicitar un nuevo grupo, porfavor envia un correo a tickets@tecnol.es',
            icon : 'info',
        })
    })
}
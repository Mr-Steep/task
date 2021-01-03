$(document).ready(function () {

    $('a[rel="nofollow"]').parent().remove()

    $('.arrow_up').on('click', async () => {
        $('.arrow_up').attr('hidden', ' ')
        $('.arrow_down').removeAttr('hidden')
        location.href = location.search.replace('ASC', 'DESC')


    })
    $('.arrow_down').on('click', async () => {
        $('.arrow_down').attr('hidden', ' ')
        $('.arrow_up').removeAttr('hidden')
        location.href = location.search.replace('DESC', 'ASC')

    })


    $('.data_task_text').on('focusout', async (e) => {
        let id = $(e.currentTarget).attr('id')
        let newData = $(`.data_task_text[id='${id}']`).val()
        await request({
            flag: 'task_update',
            id: id,
            new_data: newData
        })
    })


    $('.form-check-input').on('change', async (e) => {
        let id_el = $(e.currentTarget).attr('data-id')
        const el = $(`input[data-id='${id_el}']`).is(':checked')
        await request({
            flag: 'update_performance',
            id: id_el,
            new: el
        })
    })

    $('#login_admin').on('click', async () => {
        const ADMIN_val = $('#staticLogin').val()
        const PASS_val = $('#inputPassword').val()
        const answer = await request({
            flag: 'admin',
            login: ADMIN_val,
            pass: PASS_val
        })
        const $place = $('#staticBackdrop')

        switch (answer) {
            case 'true':
            case true:
                warning($place, 'Успешно!', '#13ab13c7')
                setTimeout(() => location.href = '/', 1404)
                break;
            default:
                warning($place, 'Введены неверные данные', '#d90e0ec7')

            //ОШИБКА
        }


    })

    $('#exit_admin24').on('click', async () => {
        const $data = await request({
            flag: 'exit_admin'
        })

        location.href = '/'
    })


    let onlineAdmin = async () => {
        const on = await request({
            flag: 'online'
        })
        switch (on) {
            case 'true':
            case true:
                ONLINE()
                break;
            default:
                OFFLINE()
                break;
        }
    }

    let ONLINE = () => {
        $('#li3').attr('hidden', ' ')
        $('#li4').removeAttr('hidden')
        $('#12navbar').attr('class', 'navbar navbar-expand-lg navbar-light bg-danger')
        $('.form-check-input').removeAttr('disabled')

    }
    let OFFLINE = () => {
        $('#li3').removeAttr('hidden')
        $('#li4').attr('hidden', ' ')
        $('#12navbar').attr('class', 'navbar navbar-expand-lg navbar-light bg-light')
        $('.form-check-input').attr('disabled', ' ')

    }

    $('#sort-user').on('click', async () => {

        let res = await request({
            flag: 'sort',
            sort: 'user',
            v: 'ASC'
        })
    })
    $('#sort-mail').on('click', async () => {

        let res = await request({
            flag: 'sort',
            sort: 'mail',
            v: 'ASC'

        })
    })
    $('#sort-status').on('click', async () => {

        let res = await request({
            flag: 'sort',
            sort: 'status',
            v: 'ASC'

        })
    })


    $('#save_task').on('click', async () => {
        const $place = $('#exampleModal')
        const UserName = $('#inputUser').val()
        const UserMail = $('#inputEmail1').val()
        const UserTask = $('#textarea1').val()


        if (UserName.length < 1) {
            warning($place, 'Введите Имя Пользователя', '#d90e0ec7')
        } else if (UserMail.length < 1) {
            warning($place, 'Введите Адрес Электронной почты', '#d90e0ec7')
        } else if (UserMail.includes('@') && UserMail.includes('.')) {
            if (UserTask.length < 1) {
                warning($place, 'Введите задачу', '#d90e0ec7')
            }
        } else {
            warning($place, 'Корректно введите Адрес Электронной почты', '#d90e0ec7')

        }


        if (UserName && UserMail.includes('@') && UserMail.includes('.') && UserTask) {

            const data = {
                flag: 'CreateTask',
                UserName: UserName,
                UserMail: UserMail,
                UserTask: UserTask
            }

            let res = await request(data)


            switch (res) {
                case 'true':
                case true:
                    warning($place, 'Добавлено', '#13ab13c7')
                    setTimeout(() => $('.btn-close').trigger('click'), 1404)


                    break;
                default:
                    warning($place, 'Ошибка, повторитке или обратитесь в службу поддержки !!', '#d90e0ec7')


            }
        }

    })


    let warning = ($place, text, color) => {
        const $ob = $(`<div> ${text}</div>`)
        $ob.css({
            'background-color': color,
            'color': '#FFF',
            'border-radius': '5px',
            'position': 'absolute',
            'font-size': '20px',
            'margin': '-155px 0 0 calc(100% / 2 - 100px)',
            'padding': '15px'
        })
        $place.append($ob)
        setTimeout(() => $ob.remove(), 1400)
    }

    let request = async (data) => {
        return await $.ajax({
            type: "POST",
            url: '/application/lib/lib.php',
            data: data
        });
    }
    onlineAdmin().then(r => r)

});

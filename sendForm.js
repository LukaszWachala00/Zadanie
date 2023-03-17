const app = Vue.createApp({
    data() {
        return {
            name: '',
            err_name: false,
            surname: '',
            err_surname: false,
            email: '',
            err_email: false,
            message: '',
        }
    },
    watch: {
        name(){
            const reg = /^[a-zA-ZąćęłńóśźżĄĆŁŃÓŚŻŹ\s]{2,50}$/;
            if(reg.test(this.name)) this.err_name=false;
            else this.err_name=true;
        },
        surname(){
            const reg = /^[a-zA-ZąćęłńóśźżĄĆŁŃÓŚŻŹ\s\-]{2,50}$/;
            if(reg.test(this.surname)) this.err_surname=false;
            else this.err_surname=true;
        },
        email(){
            const reg = /^[a-zA-Z0-9_\.]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
            if(reg.test(this.email)) this.err_email=false;
            else this.err_email=true;
        },
    }
})

app.mount('#form')
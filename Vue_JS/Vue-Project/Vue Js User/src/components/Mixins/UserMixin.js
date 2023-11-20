export default {
    data() {
        return {
           valid: true,
        password: '',
        email: '',
        emailRules: [
            v => !!v || 'E-mail is required',
            v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
        ],
        passwordRules: [
            v => !!v || 'Password is required',
            v => (v && v.length <= 8) || 'Length of Password must be of 8',
        ],
        select: null, 
        }
    },
    methods: {
        reset() {
            this.$refs.form.reset()
        },
    }
}
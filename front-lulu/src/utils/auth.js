export function userIsAdmin () {
    const isAdmin = localStorage.getItem('isAdmin')

    return isAdmin === '1'
}

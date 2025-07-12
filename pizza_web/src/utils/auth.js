
export const isLoggedIn = async () => {
  const url = import.meta.env.VITE_APP_URL;

  const response = await fetch(`${url}/api/user`, {
     method: 'GET',
      credentials: 'include',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      },
  })

  return response.status === 200;
}
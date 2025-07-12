
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

export const login = async (email, password) => {
  const url = import.meta.env.VITE_APP_URL;

  try {
    const response = await fetch(`${url}/api/login`, {
      method: 'POST',
      credentials: 'include',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      },
      body: JSON.stringify({ email, password })
    })

    const result = await response.json()

    if (!response.ok) {
      throw new Error(result.message || 'Login failed')
    }

    return { success: true }
  } catch (error) {
    return { 
      success: false, 
      message: error.message 
    }
  }
}
const URL = import.meta.env.VITE_APP_URL;

export const isLoggedIn = async () => {
  const response = await fetch(`${URL}/api/user`, {
     method: 'GET',
      credentials: 'include',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      },
  })

  return response.status === 200;
}

export const register = async (name, email, password) => {
  try {
    const response = await fetch(`${URL}/api/register`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      },
      body: JSON.stringify({ name, email, password })
    })

    const result = await response.json()

    if (!response.ok) {
      throw new Error(result.message || 'Registration failed')
    }

    return { success: true }
  } catch (error) {
    return { 
      success: false, 
      message: error.message 
    }
  }
}

export const login = async (email, password) => {
  try {
    const response = await fetch(`${URL}/api/login`, {
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

export const logout = async () => {
  try {
    await fetch(`${URL}/api/logout`, {
      method: 'POST',
      credentials: 'include',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      },
    });

    return { success: true }
  } catch (error) {
    return { 
      success: false, 
      message: error.message 
    }
  }
};

export const fetchUser = async () => {
  const response = await fetch(`${URL}/api/user`, {
     method: 'GET',
      credentials: 'include',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      },
  })

  const data = await response.json()

  return data
}
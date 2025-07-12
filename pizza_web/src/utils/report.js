export const fetchPaginated = async (endpoint, pageRef) => {
  const url = import.meta.env.VITE_APP_URL

  const response = await fetch(`${url}/api/report/${endpoint}?page=${pageRef.value}`, {
    credentials: 'include',
    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
  })
  
  const json = await response.json()

  return {
    data: json.data,
    meta: json
  }
}
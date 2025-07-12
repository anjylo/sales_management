export const uploadCsv = async (file, uploadType) => {
  const url = import.meta.env.VITE_APP_URL;

  const formData = new FormData()
  formData.append('file', file)
  formData.append('type', uploadType)

  try {
    const response = await fetch(`${url}/api/import`, {
      method: 'POST',
      credentials: 'include',
      body: formData,
    })
  
    const result = await response.json()

    if (!response.ok) {
      throw new Error(result.message || 'Upload failed')
    }

    return { success: true }
  } catch (error) {
    return { 
      success: false, 
      message: error.message 
    }
  }
}
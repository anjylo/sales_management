export const formatCurrency = (data) => {
  return new Intl.NumberFormat('en-PH', {
      style: 'currency',
      currency: 'PHP',
  }).format(data)
}
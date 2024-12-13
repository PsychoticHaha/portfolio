
const TabsContent = () => {
  return (
    <main>
      <div className="data-container">
        {/* <!-- "id", 'fullname', 'email', 'message', 'is_read', 'date' --> */}
        <table id="message-container">
          <tr>
            <th>Email</th>
            <th>Message</th>
            <th>Date</th>
          </tr>
          <tr id="1">
            <td>fanasina.ramalandimanana@gmail.com</td>
            <td>Hello, I'm tryna to contact you for some...</td>
            <td>21-12-2023 13:46</td>
          </tr>
        </table>
      </div>
    </main>
  )
}

export default TabsContent

const LogoutBtn = ({ sessionToken }: { sessionToken?: string }) => {
  return (
    <div className="logout">
      <form action="logout.php" method="POST">
        <input type="submit" name="logout" value="." />
        <input type="hidden" value={sessionToken ?? ""} />
      </form>
    </div>
  )
}

export default LogoutBtn;
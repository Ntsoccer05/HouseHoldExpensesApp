import { Home } from '@/Pages/Home'
import { Nomatch } from '@/Pages/Nomatch'
import { Report } from '@/Pages/Report'
import AppLayout from '@/context/AppContext'
import React from 'react'
import { Route, Routes } from 'react-router-dom'

function Router() {
  return (
    <Router>
      <Routes>
        <Route path='/' element={<AppLayout /> /}>
          {/* 親と同じパスはindexと記述できる */}
          <Route index element={<Home />} />
          <Route path='/report' element={<Report />} />
          {/* 最後にpath='*'で上記に当てはまらない全てのページを指す */}
          <Route path='*' element={<Nomatch />} />
        </Route>
      </Routes>
    </Router>
  )
}

export default Router
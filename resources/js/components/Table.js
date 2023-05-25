import React, { useState, useEffect, useContext } from "react";
import ReactDOM from "react-dom/client";
import { BrowserRouter, Link } from 'react-router-dom';

export default function Table(items) {
  return (
    <div>
      <table className="table">
        <thead>
          <tr>
            <th width="300">
              <div className="flex items-center">
                <button className="border-0 fw-bold">Title</button>
              </div>
            </th>
            <th width="150"><button className="border-0 fw-bold">Type</button></th>
            <th width="150"><button className="border-0 fw-bold">Priority</button></th>
            <th>Status</th>
            <th>Assignee</th>
            <th>Reporter</th>
            <th colSpan="2" className="text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
          {items?.data?.data?.map((ticket) => (
            <tr key={ticket.id}>
              <td><Link to={`/tickets/${ticket.id}`}>{ticket.title}</Link></td>
              <td>{ticket.type.name}</td>
              <td>{ticket.priority.name}</td>
              <td>{ticket.status.name}</td>
              <td>{ticket.assignee.name}</td>
              <td>{ticket.reporter.name}</td>
              <td className="text-center">
                <a href="{{ route('tickets.edit', $ticket->id) }}" className="btn btn-secondary"><i id="{{ $ticket->id }}"
                  className="fa-solid fa-pencil"></i></a>
              </td>
              <td className="text-center">
                <form action="{{ route('tickets.destroy', $ticket->id) }}" id="delete-{{ $ticket->id }}" method="POST" hidden>
                  @method('DELETE')
                  @csrf
                </form>
                <button type="button" className="btn btn-danger deleteButton" id="{{ $ticket->id }}"><i id="{{ $ticket->id }}"
                  className="fa-solid fa-trash-can"></i></button>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
}


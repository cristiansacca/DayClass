/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.cristian.dayclass;

import java.io.Serializable;
import java.util.Date;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.ManyToOne;
import javax.persistence.Table;
import javax.persistence.Temporal;

/**
 *
 * @author Cristian
 */
@Entity
@Table(name="TemaDia", schema="dayclass")
public class TemaDia implements Serializable {
    
    private static final long serialVersionUID = 1L;    
    @Id
    @GeneratedValue(strategy=GenerationType.IDENTITY)
    private int id;
    private String comentarioTema;
    @Temporal(javax.persistence.TemporalType.DATE)
    private Date fechaTemaDia;
    
    @ManyToOne
    private Curso curso;
    @ManyToOne
    private TemasMateria temasMateria;

    public TemaDia() {
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getComentarioTema() {
        return comentarioTema;
    }

    public void setComentarioTema(String comentarioTema) {
        this.comentarioTema = comentarioTema;
    }

    public Date getFechaTemaDia() {
        return fechaTemaDia;
    }

    public void setFechaTemaDia(Date fechaTemaDia) {
        this.fechaTemaDia = fechaTemaDia;
    }

    public Curso getCurso() {
        return curso;
    }

    public void setCurso(Curso curso) {
        this.curso = curso;
    }

    public TemasMateria getTemasMateria() {
        return temasMateria;
    }

    public void setTemasMateria(TemasMateria temasMateria) {
        this.temasMateria = temasMateria;
    }
    
}
